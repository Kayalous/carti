<template>
  <div class="flex flex-col items-center pt-6 mt-24 sm:justify-center sm:pt-0">
    <div>
      <slot name="logo" />
    </div>

    <div
      class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md  sm:max-w-md sm:rounded-lg"
    >
      <h1 class="mb-5 font-bold text-center text-gray-700 font-4xl">
        <slot name="title" />
      </h1>
      <slot />
    </div>
  </div>
</template>
