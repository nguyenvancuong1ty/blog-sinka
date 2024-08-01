<template>
  <div class="flex justify-center">
    <form @submit.prevent="onSubmit">
      <a-space direction="vertical w-[400px]">
        <div class="">
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
        <div class="">
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
        <div class="text-right">
          <a-button type="primary" html-type="submit">Update</a-button>
        </div>
      </a-space>
    </form>
  </div>
</template>

<script lang="ts" setup>
import { onBeforeMount, reactive, watch } from 'vue';
import { useCategory } from '@/composables/useCategory';
import { Category } from '@/services/category';
import { useRoute, useRouter } from 'vue-router';
import { NotificationMessage } from '@/util/NotificationMessage';

const { updateCategory, getCategoryById } = useCategory();

const router = useRouter();
const route = useRoute();
const id = Number(route.params.id);
//form data
const formState = reactive<Category>({
  title: '',
  description: '',
});

//Error message
const errors: Record<string, string> = reactive({
  title: '',
  description: '',
});

const onSubmit = async () => {
  const res = await updateCategory(id, formState);
  if (res.errors) {
    errors.title = res.errors.title;
    errors.description = res.errors.description;
    return;
  }
  NotificationMessage('success', 'Notification', 'Update category success');
  router.push({ name: 'categories.index' });
};
watch(formState, () => {});

onBeforeMount(async () => {
  const response = await getCategoryById(id);
  formState.title = response.title;
  formState.description = response.description;
});

const resetError = (field: string) => {
  errors[field] = '';
};
</script>
