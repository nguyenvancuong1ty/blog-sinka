<script lang="ts" setup>
import { useStore } from '../../store/home';
import Loading from '../../components/Loading.vue';
import { computed, onBeforeMount, reactive, ref, watch } from 'vue';
import { useCategory } from '../../composables/useCategory';
import { usePost } from '../../composables/usePost';
import { LeftOutlined, RightOutlined } from '@ant-design/icons-vue';
import { Post } from '../../services/post';

const store = useStore();
const searchText = computed(() => store.currentTextSearch);

const { categories, getListCategories } = useCategory();
const { posts, total, getListPosts } = usePost();

const activeTag = ref(1);
const currentTag = ref<number[]>([1]);
const loading = ref(false);
const postDefault = ref<Array<Post>>([]);
const fetchCategory = async () => {
  loading.value = true;
  await getListCategories();
  loading.value = false;
};

const fetchPost = async () => {
  loading.value = true;
  await getListPosts({
    category_id: activeTag.value,
    search: searchText.value,
    page: currentPage.value,
    limit: limit.value,
  });
  postDefault.value = [...postDefault.value, ...posts.value];
  loading.value = false;
};

onBeforeMount(async () => {
  await fetchCategory();
  await fetchPost();
});

const currentPage = ref(1);
const limit = ref(2);

watch(activeTag, async () => {
  currentPage.value = 1;
  postDefault.value = [];
});

watch([activeTag, searchText, currentPage, limit, currentTag], async () => {
  await fetchPost();
});

const setActive = (id: number) => {
  activeTag.value = id;
};

const showMore = () => {
  currentPage.value += 1;
};

const responsiveSettings = [
  {
    breakpoint: 1024,
    settings: {
      slidesToShow: 3,
      slidesToScroll: 1,
    },
  },
  {
    breakpoint: 768,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 1,
    },
  },
  {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1,
    },
  },
];
</script>

<template>
  <div
    class="category flex justify-center items-center sticky top-20 border-b overflow-x-auto bg-[#fff] py-4"
  >
    <a-carousel
      arrows
      :dots="false"
      :slidesToShow="5"
      :slidesToScroll="1"
      :responsive="responsiveSettings"
      :class="'custom w-[600px]'"
    >
      <template #prevArrow>
        <div
          class="!hidden md:!block custom-slick-arrow absolute !top-0 left-2 z-10"
        >
          <LeftOutlined class="absolute top-[40%] text-2xl text-[#7B94A8]" />
        </div>
      </template>
      <template #nextArrow>
        <div
          class="!hidden md:!block custom-slick-arrow absolute !top-0 right-2"
        >
          <RightOutlined
            class="absolute top-[40%] right-0 text-2xl text-[#7B94A8]"
          />
        </div>
      </template>
      <div v-for="item in categories" :key="item.id">
        <p
          :class="[
            'font-bold py-2 px-4 cursor-pointer mx-2 text-center rounded-full',
            item.id === activeTag
              ? 'text-[#F5F5F5] bg-[#6F6F6F]'
              : 'text-black bg-[#F5F5F5]',
          ]"
          @click="setActive(item.id as number)"
        >
          {{ item.title }}
        </p>
      </div>
    </a-carousel>
  </div>
  <div class="content flex justify-center mt-8" v-if="!loading">
    <div
      class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-4 gap-y-8 w-[80%]"
    >
      <div class="" v-for="item in postDefault">
        <img :src="item.thumbnail" alt="" class="w-full h-72 object-cover" />
        <p class="font-bold text-xl my-4 min-h-14">{{ item.title }}</p>
        <p class="text-base text-justify">
          {{ item.description.slice(0, 150) }}...
        </p>
      </div>
    </div>
  </div>
  <div class="flex justify-center my-8" v-if="!loading && posts.length > 0">
    <a-pagination
      v-model:current="currentPage"
      :total="total"
      :defaultPageSize="4"
      :pageSizeOptions="[4, 8, 12, 14, 18, 20]"
    />
    <a-button @click="showMore">show more ...</a-button>
  </div>
  <div
    class="content flex justify-center items-center fixed top-0 bottom-0 left-0 right-0"
    v-if="loading"
  >
    <Loading />
  </div>
</template>

<style></style>
