<script setup lang="ts">
import Sidebar from './Sidebar.vue';
import Header from './Header.vue';
import { computed } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

const breadcrumbs = computed(() => {
  console.log(route.path);

  const paths = route.path.split('/').filter((path) => path);
  let breadcrumbList = [{ label: 'Home', path: '/' }];

  paths.forEach((path, index) => {
    const breadcrumbPath = `/${paths.slice(0, index + 1).join('/')}`;
    breadcrumbList.push({
      label: path.charAt(0).toUpperCase() + path.slice(1), // Capitalize first letter
      path: breadcrumbPath,
    });
  });

  return breadcrumbList;
});
</script>

<template>
  <div class="flex h-screen bg-gray-200 font-roboto">
    <Sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
      <Header />

      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-8">
          <a-breadcrumb :class="'mb-16'">
            <template v-for="(breadcrumb, index) in breadcrumbs" :key="index">
              <a-breadcrumb-item>
                <router-link :to="breadcrumb.path">{{
                  breadcrumb.label
                }}</router-link>
              </a-breadcrumb-item>
            </template>
          </a-breadcrumb>

          <router-view />
        </div>
      </main>
    </div>
  </div>
</template>
