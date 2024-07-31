<script lang="ts" setup>
import { useStore } from '../../store/home';
import Loading from '../../components/Loading.vue';
import axios from 'axios';
import { computed, onBeforeMount, ref, watch } from 'vue';
import { MenuProps } from 'ant-design-vue';
import { Category } from '@/services/category';


interface Post {
  id: number;
  category_id: number;
  title: string;
  thumbnail: string;
  description: string;
  created_at: Date;
}
const store = useStore();
const searchText = computed(() => store.currentTextSearch);

const categories = ref<Array<Category>>([]);
const posts = ref<Array<Post>>([]);
const activeTag = ref(1);
const currentTag = ref<number[]>([1]);
const items = ref<MenuProps['items']>([]);
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
    url: `${import.meta.env.VITE_API_HOST}/api/post?category_id=${
      currentTag.value
    }&search=${searchText.value}&page=${current.value}&limit=${limit.value}`,
    method: 'get',
  });
  console.log(res.data.data.data);
  loading.value = false;
  total.value = res.data.data.total;
  return res.data.data.data;
};

onBeforeMount(async () => {
  categories.value = await fetch();
  items.value = categories.value.map((item) => {
    return {
      key: item.id,
      label: item.title,
      title: item.title,
    };
  });
  posts.value = await fetchPost();
});

const setActive = (id: number) => {
  activeTag.value = id;
};

const current = ref(1);
const total = ref(0);
const limit = ref(4);

watch(currentTag, async () => {
  current.value = 1;
});

watch([activeTag, searchText, current, limit, currentTag], async () => {
  posts.value = await fetchPost();
});
</script>

<template>
  <div
    class="category flex justify-center items-center sticky top-20 border-b overflow-x-auto bg-[#fff] py-4"
  >
    <a-menu
      v-model:selectedKeys="currentTag"
      mode="horizontal"
      :items="items"
      :class="'border-none'"
    />
  </div>
  <div class="content flex justify-center mt-8" v-if="!loading">
    <div
      class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-4 gap-y-8 w-[80%]"
    >
      <div class="" v-for="item in posts">
        <img :src="item.thumbnail" alt="" class="w-full h-72 object-cover" />
        <p class="font-bold text-xl my-4 min-h-14">{{ item.title }}</p>
        <p class="text-base text-justify">
          {{ item.description.slice(0, 150) }}...
        </p>
      </div>
    </div>
  </div>
  <div class="flex justify-center my-8" v-if="!loading && posts.length > 0">
    <a-pagination v-model:current="current" :total="total" :pageSize="4" />
  </div>
  <div
    class="content flex justify-center items-center fixed top-0 bottom-0 left-0 right-0"
    v-if="loading"
  >
    <Loading />
  </div>
</template>

<style></style>
