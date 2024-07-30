<script lang="ts" setup>
import Loading from '../../components/Loading.vue';
import axios from 'axios';
import { onBeforeMount, ref, watch } from 'vue';

interface Category {
  id: number;
  title: string;
  description: string;
}

interface Post {
  id: number;
  category_id: number;
  title: string;
  thumbnail: string;
  description: string;
  created_at: Date;
}

const categories = ref<Array<Category>>([]);
const posts = ref<Array<Post>>([]);
const activeTag = ref(1);
const loading = ref(false);
const fetch = async () => {
  loading.value = true;
  const res = await axios({
    url: 'http://localhost:8000/api/category',
    method: 'get',
  });
  loading.value = false;
  return res.data.data.data;
};

const fetchPost = async () => {
  loading.value = true;
  const res = await axios({
    url: `http://localhost:8000/api/post?category_id=${activeTag.value}`,
    method: 'get',
  });
  console.log(res.data.data.data);
  loading.value = false;
  return res.data.data.data;
};

onBeforeMount(async () => {
  categories.value = await fetch();
  posts.value = await fetchPost();
});

const setActive = (id: number) => {
  activeTag.value = id;
};

watch(activeTag, async () => {
  posts.value = await fetchPost();
});
</script>

<template>
  <div
    class="category flex justify-center sticky top-20 bg-[#ccc] border-b overflow-x-auto"
  >
    <span
      :class="[
        'font-bold py-2 px-4 cursor-pointer',
        item.id === activeTag ? 'text-red-500' : 'text-black',
      ]"
      v-for="item in categories"
      :key="item.id"
      @click="setActive(item.id)"
      >{{ item.title }}</span
    >
  </div>
  <div class="content flex justify-center mt-8" v-if="!loading">
    <div
      class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-4 gap-y-8 w-[80%]"
    >
      <div class="" v-for="item in posts">
        <img :src="item.thumbnail" alt="" class="w-full h-72 object-cover" />
        <p class="font-bold text-xl my-4">{{ item.title }}</p>
        <p class="text-base text-justify">{{ item.description }}</p>
      </div>
    </div>
  </div>
  <div
    class="content flex justify-center items-center fixed top-0 bottom-0 left-0 right-0"
    v-if="loading"
  >
    <Loading />
  </div>
</template>

<style></style>
