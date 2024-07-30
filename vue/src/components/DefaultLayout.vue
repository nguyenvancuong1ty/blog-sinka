<script setup lang="ts"></script>

<template>
  <div class="wrap w-screen h-screen flex justify-center items-center">
    <div class="web rounded-xl w-9/12 h-[95%] bg-[#ccc] overflow-y-auto">
      <header
        class="flex justify-between min-h-20 px-4 items-center sticky top-0 bg-[#ccc]"
      >
        <div class="flex items-center">
          <font-awesome-icon icon="bars" />
          <p class="font-bold ml-4">/Homepage</p>
        </div>
        <input
          type="text"
          class="border-none outline-none rounded-full w-72"
          placeholder="search topic"
        />
        <div class="flex items-center">
          <font-awesome-icon icon="user" />
          <p class="font-bold ml-4">Me</p>
        </div>
      </header>

      <div class="content px-4">
        <router-view />
      </div>
    </div>
  </div>
</template>

<style scoped>
.wrap {
  background-color: rgba(0, 0, 0, 0.8);
}
.web {
  box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px,
    rgba(0, 0, 0, 0.3) 0px 30px 60px -30px,
    rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
}
</style>
