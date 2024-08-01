<template>
  <div class="flex justify-center">
    <form @submit.prevent="onSubmit">
      <a-space direction="vertical min-w-[400px]">
        <div class="mb-4">
          <p class="font-bold text-base min-w-24 m-0">Title</p>
          <a-input
            v-model:value="formState.title"
            placeholder="Title"
            @input="resetError('title')"
          />
        </div>
        <span class="error-text text-red-600 font-medium">{{
          errors.title
        }}</span>
        <div class="mb-4">
          <p class="font-bold text-base min-w-24 m-0">Description</p>
          <a-input
            v-model:value="formState.description"
            placeholder="Description"
            @input="resetError('description')"
          />
        </div>
        <span class="error-text text-red-600 font-medium">{{
          errors.description
        }}</span>
        <div class="mb-4">
          <p class="font-bold text-base min-w-24 m-0">Category</p>
          <a-radio-group
            v-model:value="formState.category_id"
            button-style="solid"
            :class="'flex'"
          >
            <a-radio-button v-for="item in categories" :value="item.id">{{
              item.title
            }}</a-radio-button>
          </a-radio-group>
        </div>
        <div class="mb-4 w-full">
          <p class="font-bold text-base min-w-24 m-0">Thumbnail</p>
          <input v-model="formState.thumbnail" class="w-full" />
          <img :src="formState.thumbnail" alt="" class="w-20" />
        </div>
        <div class="mb-4">
          <p class="font-bold text-base min-w-24 m-0">Thumbnail</p>
          <input type="file" />
        </div>
        <div class="text-right mt-8">
          <a-button type="primary" html-type="submit">Create</a-button>
        </div>
      </a-space>
    </form>
  </div>
</template>

<script lang="ts" setup>
import { onBeforeMount, reactive, watch } from 'vue';
import { useCategory } from '@/composables/useCategory';
import { useRouter } from 'vue-router';
import { NotificationMessage } from '@/util/NotificationMessage';
import { Post } from '@/services/post';
import { usePost } from '@/composables/usePost';

const { createPost } = usePost();
const { categories, getListCategories } = useCategory();

const route = useRouter();

//form data
const formState = reactive<Partial<Post>>({
  title: '',
  description: '',
  category_id: 1,
  thumbnail: '',
});

//Error message
const errors: Record<string, string> = reactive({
  title: '',
  description: '',
});

const onSubmit = async () => {
  const res = await createPost(formState);
  if (res.errors) {
    errors.title = res.errors.title;
    errors.description = res.errors.description;
    return;
  }
  NotificationMessage('success', 'Notification', 'Create post success');
  route.push({ name: 'post.index' });
};
watch(formState, () => {
  console.log(formState);
});

onBeforeMount(async () => {
  await getListCategories();
});

const resetError = (field: string) => {
  errors[field] = '';
};
</script>
