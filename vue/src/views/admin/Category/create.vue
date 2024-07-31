<template>
  <div class="flex justify-center">
    <form @submit.prevent="onSubmit">
      <a-space direction="vertical">
        <a-input v-model:value="formState.title" placeholder="Title" />
        <span class="error-text text-red-600 font-medium">{{
          errors.title
        }}</span>
        <a-input
          v-model:value="formState.description"
          placeholder="Description"
        />
        <span class="error-text text-red-600 font-medium">{{
          errors.description
        }}</span>
        <a-button type="primary" html-type="submit">Create</a-button>
      </a-space>
    </form>
  </div>
</template>

<script lang="ts" setup>
import { reactive, watch } from 'vue';
import { useCategory } from '@/composables/useCategory';
import { Category } from '@/services/category';

const { createCategory } = useCategory();
const formState = reactive<Category>({
  title: '',
  description: '',
});
const errors = reactive({
  title: '',
  description: '',
});
const onSubmit = async () => {
  const res = await createCategory(formState);
  if (res.errors) {
    errors.title = res.errors.title;
    errors.description = res.errors.description;
  }
};
watch(formState, () => {});
</script>
