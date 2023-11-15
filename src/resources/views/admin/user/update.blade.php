@extends('layouts.admin', ['body_class' => 'bg-custom-background'])
@section('title', $viewData['title'])
@section('content')


    {{ Breadcrumbs::render('homeAdmin.users.edit', $viewData['user_info']) }} 


    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <section class="bg-white rounded-lg shadow-lg max-w-2xl px-4 py-8 mx-auto lg:py-16">
        
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{ $viewData['title'] }}</h2>
            <form action="{{ route('admin.user.update', $viewData['user_info']->getId()) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        @if (session('success'))
                            <p class="mt-2 text-sm text-green-600 dark:text-green-500">{{ session('success') }}</p>
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" value={{ $viewData['user_info']->getName() }}
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="Apple iMac 27&ldquo;" placeholder="User Name" required="true">
                    </div>
                    <div>
                        <label for="rol"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('order.rol')}}</label>
                        <select name="rol" id="rol"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="customer"
                                {{ $viewData['user_info']->getRol() === 'customer' ? 'selected' : '' }}>
                                Customer</option>
                            <option value="admin" {{ $viewData['user_info']->getRol() === 'admin' ? 'selected' : '' }}>
                                {{__('order.update_order')}}
                            </option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="Email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('order.email')}}</label>
                        <input type="email" name="email" id="Email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value={{ $viewData['user_info']->getEmail() }} placeholder="Email" required="true">
                    </div>
                    <div class="w-full">
                        <label for="balance"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('order.update_order')}}</label>
                        <input type="number" name="balance" id="balance"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value={{ $viewData['user_info']->getBalance() }} placeholder="$$$" required="true">
                    </div>

                    <div>
                        <label for="username"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('order.username')}}</label>
                        <input type="text" name="username" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value={{ $viewData['user_info']->getUserName() }} placeholder="Ex. bestUser123" required="true">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="Password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('order.admin_password')}}
                        </label>
                        <input type="password" id="admin_password" name="password"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="****">
                        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400"> {{__('user.password_description')}}</p>
                        @if (session('error'))
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ session('error') }}</p>
                        @endif

                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        {{__('user.update_user')}}
                    </button>
                </div>
            </form>

        
    </section>
@endsection
