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
          <a-button type="primary" html-type="submit">Create</a-button>
        </div>
      </a-space>
    </form>
  </div>
</template>

<script lang="ts" setup>
import { reactive, watch } from 'vue';
import { useCategory } from '@/composables/useCategory';
import { Category } from '@/services/category';
import { useRouter } from 'vue-router';
import { NotificationMessage } from '@/util/NotificationMessage';

const { createCategory } = useCategory();

const route = useRouter();

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
  const res = await createCategory(formState);
  if (res.errors) {
    errors.title = res.errors.title;
    errors.description = res.errors.description;
    return;
  }
  NotificationMessage('success');
  route.push({ name: 'categories.index' });
};
watch(formState, () => {});

const resetError = (field: string) => {
  errors[field] = '';
};
</script>
