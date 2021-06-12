<template>
  <section class="flex flex-col justify-center text-gray-600 body-font">
    <h2
      class="inline mx-auto text-4xl font-extrabold tracking-tighter text-center  alt text-cool-gray-700 sm:text-6xl underlined"
    >
      How it works
    </h2>
    <p
      class="max-w-3xl mx-auto mt-5 text-base text-center  text-cool-gray-700 md:text-2xl"
    >
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi id maxime
      excepturi maiores dicta cupiditate reiciendis velit alias dolorum ea.
      Illo, consequuntur molestias! Saepe fuga quia deleniti incidunt?
      Voluptatem, molestias!
    </p>
    <div class="container flex flex-wrap px-5 py-24 mx-auto">
      <div class="w-full mb-10 overflow-hidden rounded lg:w-1/2 lg:mb-0">
        <img
          alt="feature"
          class="object-cover object-center w-full h-full"
          src="/images/cart.jpg"
        />
      </div>
      <div
        class="flex flex-col flex-wrap -mb-10 text-center  lg:py-6 lg:w-1/2 lg:pl-12 lg:text-left"
      >
        <div class="flex flex-col items-center mb-10 lg:items-start">
          <div
            class="inline-flex items-center justify-center w-12 h-12 mb-5 text-teal-600 bg-teal-100 rounded-full "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-8 h-8"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <circle cx="9" cy="7" r="4" />
              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
              <path d="M16 11l2 2l4 -4" />
            </svg>
          </div>
          <div class="flex-grow">
            <h2 class="mb-3 text-lg font-medium text-gray-900 title-font">
              Download the app and register
            </h2>
            <p class="text-base leading-relaxed">
              Blue bottle crucifix vinyl post-ironic four dollar toast vegan
              taxidermy. Gastropub indxgo juice poutine.
            </p>
          </div>
        </div>
        <div class="flex flex-col items-center mb-10 lg:items-start">
          <div
            class="inline-flex items-center justify-center w-12 h-12 mb-5 text-teal-600 bg-teal-100 rounded-full "
          >
            <svg
              fill="none"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.5"
              class="w-8 h-8"
              viewBox="0 0 24 24"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <circle cx="6" cy="19" r="2" />
              <circle cx="17" cy="19" r="2" />
              <path d="M17 17h-11v-14h-2" />
              <path d="M6 5l6.005 .429m7.138 6.573l-.143 .998h-13" />
              <path d="M15 6h6m-3 -3v6" />
            </svg>
          </div>
          <div class="flex-grow">
            <h2 class="mb-3 text-lg font-medium text-gray-900 title-font">
              Add items to your cart
            </h2>
            <p class="text-base leading-relaxed">
              Blue bottle crucifix vinyl post-ironic four dollar toast vegan
              taxidermy. Gastropub indxgo juice poutine. Blue bottle crucifix
              vinyl post-ironic four dollar toast vegan taxidermy. Gastropub
              indxgo juice poutine.
            </p>
            <a class="inline-flex items-center mt-3 text-teal-600"
              >Learn More
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                class="w-4 h-4 ml-2"
                viewBox="0 0 24 24"
              >
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
        <div class="flex flex-col items-center mb-10 lg:items-start">
          <div
            class="inline-flex items-center justify-center w-12 h-12 mb-5 text-teal-600 bg-teal-100 rounded-full "
          >
            <svg
              fill="none"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.5"
              class="w-8 h-8"
              viewBox="0 0 24 24"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <rect x="7" y="9" width="14" height="10" rx="2" />
              <circle cx="14" cy="14" r="2" />
              <path
                d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2"
              />
            </svg>
          </div>
          <div class="flex-grow">
            <h2 class="mb-3 text-lg font-medium text-gray-900 title-font">
              Checkout with your prefered payment method
            </h2>
            <p class="text-base leading-relaxed">
              Blue bottle crucifix vinyl post-ironic four dollar toast vegan
              taxidermy. Gastropub indxgo juice poutine.
            </p>
            <a class="inline-flex items-center mt-3 text-teal-600"
              >Learn More
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                class="w-4 h-4 ml-2"
                viewBox="0 0 24 24"
              >
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "How it works",
};
</script>

<style scoped>
</style>
