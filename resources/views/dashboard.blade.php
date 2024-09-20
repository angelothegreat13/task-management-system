<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Management System</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head> 
    <body class="font-sans antialiased">
      <header class="border-b border-gray-200 bg-gray-50">
        <div class="mx-auto max-w-screen-xl px-4 py-4 sm:px-6 sm:py-12 lg:px-8">
          <div class="flex flex-col items-start gap-4 md:flex-row md:items-center md:justify-between">
            <div>
              <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Task Management</h1>
              <p class="mt-1.5 text-sm text-gray-500">
                Hello, Michael Angelo Manaog
              </p>
            </div>
            <div class="flex items-center gap-4">
              <button
                class="inline-flex items-center justify-center gap-1.5 rounded border border-gray-200 bg-white px-5 py-3 text-gray-900 transition hover:text-gray-700 focus:outline-none focus:ring"
                type="button"
              >
                <span class="text-sm font-medium"> Logout </span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
              </button>
              <button
                class="inline-block rounded bg-indigo-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring"
                type="button"
              >
                Create Task
              </button>
            </div>
          </div>
        </div>
      </header>

      <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <dl class="mt-6 grid grid-cols-1 gap-4 sm:mt-8 sm:grid-cols-2 lg:grid-cols-4">
          <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">New</dt>
      
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">$4.8m</dd>
          </div>
      
          <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">In Progress</dt>
      
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">24</dd>
          </div>
      
          <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">Under Review</dt>
      
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">86</dd>
          </div>
      
          <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">Completed</dt>
      
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">86k</dd>
          </div>
        </dl>
      </div>

      <!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<div class="rounded-lg border border-gray-200">
  <div class="overflow-x-auto rounded-t-lg">
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
      <thead class="ltr:text-left rtl:text-right">
        <tr>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Date of Birth</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Salary</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-200">
        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">John Doe</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">24/05/1995</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">Web Developer</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">$120,000</td>
        </tr>

        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Jane Doe</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">04/11/1980</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">Web Designer</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">$100,000</td>
        </tr>

        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Gary Barlow</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">24/05/1995</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">Singer</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">$20,000</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
    <ol class="flex justify-end gap-1 text-xs font-medium">
      <li>
        <a
          href="#"
          class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180"
        >
          <span class="sr-only">Prev Page</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-3"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
              clip-rule="evenodd"
            />
          </svg>
        </a>
      </li>

      <li>
        <a
          href="#"
          class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
        >
          1
        </a>
      </li>

      <li class="block size-8 rounded border-blue-600 bg-blue-600 text-center leading-8 text-white">
        2
      </li>

      <li>
        <a
          href="#"
          class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
        >
          3
        </a>
      </li>

      <li>
        <a
          href="#"
          class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
        >
          4
        </a>
      </li>

      <li>
        <a
          href="#"
          class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180"
        >
          <span class="sr-only">Next Page</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-3"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
              clip-rule="evenodd"
            />
          </svg>
        </a>
      </li>
    </ol>
  </div>
</div>
    </body>
</html>
