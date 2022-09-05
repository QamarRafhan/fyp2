<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\PushSubscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\Traits\Sortable;
use App\Http\Controllers\API\Traits\Searchable;
use App\Http\Resources\API\NotificationResource;
use App\Http\Requests\API\PushSubscriptionRequest;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class NotificationController extends Controller 
{
    use Sortable;
    use Searchable;

    /**
     * Get all notifications for current user
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) 
    {
        /** @var MorphMany $query */
        $query = $request->user()->notifications();

        return $this->listNotifications($query, $request);
    }

    /**
     * Get all read notifications for current user
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReadNotifications(Request $request) 
    {

        /** @var MorphMany $query */
        $query = $request->user()->readNotifications();

        return $this->listNotifications($query, $request);
    }

    /**
     * Get all unread notifications for current user
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnreadNotifications(Request $request) 
    {
        /** @var MorphMany $query */
        $query = $request->user()->unreadNotifications();

        return $this->listNotifications($query, $request);
    }

    /**
     * Get count for unread notifications
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnreadNotificationsCount(Request $request) 
    {
        return new JsonResponse([
            'notifications_count' => $request->user()->unreadNotifications()->count()
        ]);
    }



    /**
     * Read specific notification for current user
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead(Request $request, $id) 
    {

        $notification = $request->user()->notifications()->whereId($id)->first();

        // throw_if(!$notification, abort(404));

        if (!$notification) {
            return response()->json(['message' => 'Not Found.'], 404);
        }
        return DB::transaction(function () use ($notification) {

            $notification->markAsRead();

            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        });
    }

    /**
     * Read all the notifications for current user
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAllAsRead(Request $request) 
    {

        return DB::transaction(function () use ($request) {

            $request->user()->unreadNotifications()->update(['read_at' => now()]);

            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        });
    }


    /**
     * Delete user notification 
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request) 
    {

        $notification = $request->user()->notifications()->whereId($request->input('id'))->first();

        if (!$notification) {
            return response()->json(['message' => 'Not Found.'], 404);
        }
        return DB::transaction(function () use ($notification) {
            $notification->delete();
            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        });
    }

    /**
     * Deletes all the notifications for current user
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request) 
    {

        return DB::transaction(function () use ($request) {

            $request->user()->notifications()->delete();

            return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
        });
    }

    /**
     * Subscribe device id for current user
     *
     * @param \App\Http\Requests\API\PushSubscriptionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(PushSubscriptionRequest $request) 
    {
        if ($user = $request->user()) {

            $subscription = PushSubscription::firstOrNew(['subscription' => $request->input('subscription')]);

            $subscription->user()->associate($user);

            $subscription->save();
        }

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Un-subscribe device id for current user
     *
     * @param \App\Http\Requests\Api\PushSubscriptionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unsubscribe(PushSubscriptionRequest $request) 
    {
        $subscription = $request->input('subscription');

        if ($existing = PushSubscription::where('subscription', $subscription)->first()) {
            $existing->delete();
        }

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Apply sorting & pagination on $query
     *
     * @param MorphMany $query
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function listNotifications(MorphMany $query, Request $request) 
    {
        app()->setLocale($request->user()->locale);
        $request->merge([
            'sort' => 'created_at'
        ]);
        $this->applySorting($request, $query);

        if (!blank($request->input('type'))) $query->where($query->qualifyColumn('type'), $request->input('type'));

        $notifications = $query->paginate(
            $request->per_page ?? config('app.global.record_per_page')
        );

        return NotificationResource::collection($notifications);
    }


}
