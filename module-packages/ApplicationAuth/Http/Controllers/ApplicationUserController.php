<?php

namespace Modules\ApplicationAuth\Http\Controllers;

use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\ApplicationAuth\Http\Requests\ApplicationUserRequest;
use Modules\ApplicationAuth\Transformers\ApplicationUserResource;

class ApplicationUserController extends Controller
{
    /** @var \Illuminate\Contracts\Config\Repository */
    protected Repository $config;

    /** @var string */
    protected string $guardName;

    /** @var \Illuminate\Contracts\Auth\Guard|\Tymon\JWTAuth\JWTGuard|\Tymon\JWTAuth\JWT */
    protected Guard $guard;

    /**
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Illuminate\Contracts\Auth\Factory $auth
     */
    public function __construct(Repository $config, Auth $auth)
    {
        $this->config = $config;
        $this->guardName = $config->get('application-auth.auth.guard', 'application');
        $this->guard = $auth->guard($this->guardName);

        $this->middleware('auth:' . $config->get('application-auth.auth.guard'));
    }

    /**
     * Show the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Modules\ApplicationAuth\Transformers\ApplicationUserResource
     */
    public function show(Request $request): ApplicationUserResource
    {
        /** @var \Modules\ApplicationAuth\Transformers\ApplicationUserResource $resource */
        $resource = $this->config->get('application-auth.resource', ApplicationUserResource::class);

        return $resource::make($request->user());
    }

    /**
     * Update the authenticated user's data.
     *
     * @param \Modules\ApplicationAuth\Http\Requests\ApplicationUserRequest $request
     * @return \Modules\ApplicationAuth\Transformers\ApplicationUserResource
     * @throws \Throwable
     */
    public function update(ApplicationUserRequest $request): ApplicationUserResource
    {
        /** @var \Modules\ApplicationAuth\Entities\ApplicationUser $user */
        $user = $request->user();

        DB::transaction(
            function () use ($request, $user) {
                $user->fill($request->validated());
                $user->save();
            }
        );

        /** @var \Modules\ApplicationAuth\Transformers\ApplicationUserResource $resource */
        $resource = $this->config->get('application-auth.resource', ApplicationUserResource::class);

        return $resource::make($user->fresh());
    }
}
