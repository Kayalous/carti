@extends(backpack_view('blank'))


@section('content')
    <h1 class="text-xl text-gray-800 font-bold">Welcome, {{ explode(' ',trim(Auth::user()->name))[0]}}!</h1>
    <div class="flex-1 py-4 lg:py-10">
        <div class="max-w-screen-2xl mx-auto">

            <!-- cards row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 2xl:gap-8">

                <!-- monthly target -->
                <div class="col-span-1 bg-white rounded-lg px-4 lg:px-8 py-4 lg:py-6">
                    <h2 class="text-xl text-blue-900 font-bold mb-4 lg:mb-6">Monthly target</h2>
                    <div class="flex space-x-4 items-end mb-4 lg:mb-6">
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.736 6.979C9.208 6.193 9.696 6 10 6c.304 0 .792.193 1.264.979a1 1 0 001.715-1.029C12.279 4.784 11.232 4 10 4s-2.279.784-2.979 1.95c-.285.475-.507 1-.67 1.55H6a1 1 0 000 2h.013a9.358 9.358 0 000 1H6a1 1 0 100 2h.351c.163.55.385 1.075.67 1.55C7.721 15.216 8.768 16 10 16s2.279-.784 2.979-1.95a1 1 0 10-1.715-1.029c-.472.786-.96.979-1.264.979-.304 0-.792-.193-1.264-.979a4.265 4.265 0 01-.264-.521H10a1 1 0 100-2H8.017a7.36 7.36 0 010-1H10a1 1 0 100-2H8.472c.08-.185.167-.36.264-.521z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-2xl mb-2 text-blue-900">&euro;21.291,09</span>
                        <span
                            class="text-blue-900 opacity-70 mb-2 whitespace-pre hidden xl:inline-block">/ &euro;40.000</span>
                    </div>
                    <div class="rounded-full bg-green-50 h-7 overflow-hidden">
                        <div style="width:65%;"
                             class="bg-green-400 h-7 rounded-full text-center text-green-50 flex items-center justify-center">
                            65%
                        </div>
                    </div>
                </div>
                <!--/ monthly target -->

                <!-- customers -->
                <div class="col-span-1 bg-white rounded-lg px-4 lg:px-8 py-4 lg:py-6">
                    <h2 class="text-xl text-blue-900 font-bold mb-4 lg:mb-6">Customers</h2>
                    <div class="flex space-x-4 items-end mb-4 lg:mb-6">
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-2xl mb-2">491</span>
                        <span class="text-green-500 text-base mb-2 bg-green-100 border-full  px-3 rounded-full">&#8605; 32</span>
                    </div>
                    <p>Customers this month</p>
                </div>
                <!--/ customers -->

                <!-- sales -->
                <div class="col-span-1 bg-white rounded-lg px-4 lg:px-8 py-4 lg:py-6">
                    <h2 class="text-xl text-blue-900 font-bold mb-4 lg:mb-6">Sales</h2>
                    <div class="flex space-x-4 items-end mb-4 lg:mb-6">
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl mb-2">230</span>
                        <span class="text-red-500 text-base mb-2 bg-red-100 border-full  px-3 rounded-full">
                <span class="transform rotate-180 inline-block">
                  &#8604;
                </span>
                12
              </span>
                    </div>
                    <p>Sales this month</p>
                </div>
                <!--/ sales -->

            </div>
            <!--/ cards row -->

            <!-- recent orders -->
            <div class="bg-white rounded-lg px-4 lg:px-8 py-4 lg:py-6 mt-8">
                <h2 class="text-xl text-blue-900 font-bold mb-4 lg:mb-6">Recent orders</h2>
                <div class="overflow-x-auto">
                    <div class="align-middle inline-block min-w-full overflow-hidden">
                        <table class="min-w-full">
                            <thead class="text-left bg-blue-50">
                            <tr>
                                <th class="py-2 px-3">ID</th>
                                <th class="py-2 px-3">Product</th>
                                <th class="py-2 px-3">Customer</th>
                                <th class="py-2 px-3">Date</th>
                                <th class="py-2 px-3">Status</th>
                                <th class="py-2 px-3">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-blue-100 text-blue-900 text-opacity-80 whitespace-nowrap">
                            <tr>
                                <td class="py-3 px-3">#12831</td>
                                <td class="py-3 px-3">Traditional Package</td>
                                <td class="py-3 px-3">Frances Nichols</td>
                                <td class="py-3 px-3">12-01-2021</td>
                                <td class="py-3 px-3">
                      <span
                          class="bg-green-100 text-green-500 text-xs rounded-full px-3 py-1  w-16 inline-block text-center  uppercase">Done</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 px-3">#12830</td>
                                <td class="py-3 px-3">Pro Package</td>
                                <td class="py-3 px-3">Ronald George</td>
                                <td class="py-3 px-3">12-01-2021</td>
                                <td class="py-3 px-3">
                      <span
                          class="bg-green-100 text-green-500 text-xs rounded-full px-3 py-1  w-16 inline-block text-center  uppercase">Done</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 px-3">#12829</td>
                                <td class="py-3 px-3">Pro Package</td>
                                <td class="py-3 px-3">Charlene Scott</td>
                                <td class="py-3 px-3">12-01-2021</td>
                                <td class="py-3 px-3">
                      <span
                          class="bg-red-100 text-red-500 text-xs rounded-full px-3 py-1  w-16 inline-block text-center  uppercase">Failed</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 px-3">#12828</td>
                                <td class="py-3 px-3">Starter Package</td>
                                <td class="py-3 px-3">Beverley Owens</td>
                                <td class="py-3 px-3">11-01-2021</td>
                                <td class="py-3 px-3">
                      <span
                          class="bg-green-100 text-green-500 text-xs rounded-full px-3 py-1 w-16 inline-block text-center uppercase">Done</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 px-3">#12827</td>
                                <td class="py-3 px-3">Pro Package</td>
                                <td class="py-3 px-3">Julian Hansen</td>
                                <td class="py-3 px-3">11-01-2021</td>
                                <td class="py-3 px-3">
                      <span
                          class="bg-yellow-100 text-yellow-500 text-xs rounded-full px-3 py-1 w-16 inline-block text-center uppercase">Hold</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 px-3">#12826</td>
                                <td class="py-3 px-3">Pro Package</td>
                                <td class="py-3 px-3">Nathan Howell</td>
                                <td class="py-3 px-3">11-01-2021</td>
                                <td class="py-3 px-3">
                      <span
                          class="bg-green-100 text-green-500 text-xs rounded-full px-3 py-1 w-16 inline-block text-center uppercase">Done</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="#" class="font-bold text-blue-600 inline-block mt-5 hover:underline">View all orders</a>
            </div>
            <!--/ recent orders -->


            <!-- quick actions -->
            <div
                class=" bg-white rounded-lg px-4 lg:px-8 py-4 lg:py-6 mt-8 flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-12">
                <div>
                    <h2 class="text-xl text-blue-900 font-bold mb-2">Quick actions</h2>
                    <p class="text-blue-900 opacity-70">Your recently most used actions</p>
                </div>
                <nav class="md:flex md:space-x-4 space-y-2 md:space-y-0">
                    <a href="#"
                       class="inline-flex flex-col justify-center items-center px-3 py-3 border border-blue-100 rounded-lg hover:bg-blue-50 w-32">
                        <svg class="w-8 h-8 text-blue-900" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                        </svg>
                        <span class="text-blue-900 opacity-70">
                Create User
              </span>
                    </a>
                    <a href="#"
                       class="inline-flex flex-col justify-center items-center px-3 py-3 border border-blue-100 rounded-lg hover:bg-blue-50 w-32">
                        <svg class="w-8 h-8 text-blue-900" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-blue-900 opacity-70">
                Create File
              </span>
                    </a>
                    <a href="#"
                       class="inline-flex flex-col justify-center items-center px-3 py-3 border border-blue-100 rounded-lg hover:bg-blue-50 w-32">
                        <svg class="w-8 h-8 text-blue-900" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                        <span class="text-blue-900 opacity-70">
                Edit User
              </span>
                    </a>
                    <a href="#"
                       class="inline-flex flex-col justify-center items-center px-3 py-3 border border-blue-100 rounded-lg hover:bg-blue-50 w-32">
                        <svg class="w-8 h-8 text-blue-900" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-blue-900 opacity-70">
                View Stats
              </span>
                    </a>
                </nav>
            </div>
            <!--/ quick actions -->

            <!-- top customers -->
            <div class="bg-white rounded-lg px-4 lg:px-8 py-4 lg:py-6 mt-8">
                <h2 class="text-xl text-blue-900 font-bold mb-4 lg:mb-6">Top customers</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-12">
                    <div class="space-y-4 md:max-w-sm">
                        <a href=""
                           class="w-full flex items-center space-x-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-60">
                            <img src="images/customer1.jpg" alt="Danielle Arnold" class="w-14 h-14 rounded-full">
                            <div class="flex flex-col items-start  text-sm flex-1">
                                <span class="font-bold text-blue-900 ">Danielle Arnold</span>
                                <span class="font-bold text-sm text-blue-800 opacity-50">View profile</span>
                            </div>
                            <span class="text-green-500 text-base mb-2 bg-green-100 border-full  px-3 rounded-full">&euro;438</span>
                        </a>
                        <a href=""
                           class="w-full flex items-center space-x-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-60">
                            <img src="images/customer2.jpg" alt="Leta Washington" class="w-14 h-14 rounded-full">
                            <div class="flex flex-col items-start  text-sm flex-1">
                                <span class="font-bold text-blue-900 ">Leta Washington</span>
                                <span class="font-bold text-sm text-blue-800 opacity-50">View profile</span>
                            </div>
                            <span class="text-green-500 text-base mb-2 bg-green-100 border-full  px-3 rounded-full">&euro;256</span>
                        </a>
                        <a href=""
                           class="w-full flex items-center space-x-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-60">
                            <img src="images/customer3.jpg" alt="Clinton Torres" class="w-14 h-14 rounded-full">
                            <div class="flex flex-col items-start  text-sm flex-1">
                                <span class="font-bold text-blue-900 ">Clinton Torres</span>
                                <span class="font-bold text-sm text-blue-800 opacity-50">View profile</span>
                            </div>
                            <span class="text-green-500 text-base mb-2 bg-green-100 border-full  px-3 rounded-full">&euro;149</span>
                        </a>
                    </div>
                    <div class="space-y-4 md:max-w-sm">
                        <a href=""
                           class="w-full flex items-center space-x-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-60">
                            <img src="images/customer4.jpg" alt="Sonia Watkins" class="w-14 h-14 rounded-full">
                            <div class="flex flex-col items-start  text-sm flex-1">
                                <span class="font-bold text-blue-900 ">Sonia Watkins</span>
                                <span class="font-bold text-sm text-blue-800 opacity-50">View profile</span>
                            </div>
                            <span class="text-green-500 text-base mb-2 bg-green-100 border-full  px-3 rounded-full">&euro;136</span>
                        </a>
                        <a href=""
                           class="w-full flex items-center space-x-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-60">
                            <img src="images/customer5.jpg" alt="Arthur Garcia" class="w-14 h-14 rounded-full">
                            <div class="flex flex-col items-start  text-sm flex-1">
                                <span class="font-bold text-blue-900 ">Arthur Garcia</span>
                                <span class="font-bold text-sm text-blue-800 opacity-50">View profile</span>
                            </div>
                            <span class="text-green-500 text-base mb-2 bg-green-100 border-full  px-3 rounded-full">&euro;128</span>
                        </a>
                        <a href=""
                           class="w-full flex items-center space-x-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-60">
                            <img src="images/customer6.jpg" alt="Clinton Torres" class="w-14 h-14 rounded-full">
                            <div class="flex flex-col items-start  text-sm flex-1">
                                <span class="font-bold text-blue-900 ">Gerald Beck</span>
                                <span class="font-bold text-sm text-blue-800 opacity-50">View profile</span>
                            </div>
                            <span class="text-green-500 text-base mb-2 bg-green-100 border-full  px-3 rounded-full">&euro;97</span>
                        </a>
                    </div>
                </div>
                <a href="#" class="font-bold text-blue-600 inline-block mt-5 hover:underline">View all customers</a>
            </div>
            <!--/ top customers -->

        </div>
    </div>
@endsection
