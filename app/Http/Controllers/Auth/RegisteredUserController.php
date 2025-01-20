<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'account_type' => 'required|string|in:customer,seller',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->account_type == 'seller') {

            $admin_role = Role::where('alias', Role::ADMIN_ROLE_ALIAS)->first();
            $user->roles()->attach($admin_role?->id);
        } else {

            $customer_role = Role::where('alias', Role::CLIENT_ROLE_ALIAS)->first();

            $user->roles()->attach($customer_role?->id);

            $customer = Customer::firstOrCreate(
                [
                    'email' => $user->email
                ],
                [
                    'reference' => 'CUST' . Str::random(8),
                    'email' => $user->email,
                    'name' => $user->name,
                ]
            );

            $customer->update(['user_id' => $user->id]);
        }



        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
