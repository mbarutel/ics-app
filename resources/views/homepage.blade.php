<x-layout>

    <div class="container mx-auto px-4 py-8 md:py-12">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-7/12 py-3 md:py-5">
                <h1 class="text-5xl font-bold">Remember Writing?</h1>
                <p class="text-lg text-gray-600 mt-4">Are you sick of short tweets and impersonal &ldquo;shared&rdquo;
                    posts that
                    are reminiscent of the late 90&rsquo;s email forwards? We believe getting back to actually writing
                    is the key to enjoying the internet again. Our users have authored 2 posts.</p>
            </div>
            <div class="lg:w-5/12 lg:pl-5 pb-3 py-5">
                <form action="/register" method="POST" id="registration-form" class="space-y-4">
                    @csrf
                    <div>
                        <label for="username-register" class="text-gray-600 text-sm">Username</label>
                        <input value="{{ old('username') }}" name="username" id="username-register"
                            class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300" type="text"
                            placeholder="Pick a username" autocomplete="off" />
                        @error('username')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email-register" class="text-gray-600 text-sm">Email</label>
                        <input value="{{ old('email') }}" name="email" id="email-register"
                            class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300" type="text"
                            placeholder="you@example.com" autocomplete="off" />
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password-register" class="text-gray-600 text-sm">Password</label>
                        <input name="password" id="password-register"
                            class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300" type="password"
                            placeholder="Create a password" />
                        @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password-register-confirm" class="text-gray-600 text-sm">Confirm Password</label>
                        <input name="password_confirmation" id="password-register-confirm"
                            class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300" type="password"
                            placeholder="Confirm password" />
                    </div>

                    <button type="submit"
                        class="w-full py-3 mt-4 bg-green-600 text-white text-lg font-semibold rounded-md hover:bg-green-700">Sign
                        up for OurApp</button>
                </form>
            </div>
        </div>
    </div>

</x-layout>
