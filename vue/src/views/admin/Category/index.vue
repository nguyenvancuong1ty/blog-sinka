<template>
  <div class="flex justify-end my-8">
    <a-button type="primary" :size="size"
      ><router-link to="categories/create">Create category</router-link>
    </a-button>
  </div>
  <a-table :columns="columns" :data-source="categories" :pagination="false">
    <template #headerCell="{ column }">
      <template v-if="column.key === 'id'">
        <span> Id </span>
      </template>
    </template>

    <template #bodyCell="{ column, record }">
      <template v-if="column.key === 'id'">
        <a>
          {{ record.id }}
        </a>
      </template>
      <template v-else-if="column.key === 'action'">
        <div class="flex">
          <a-button type="primary">Update</a-button>
          <a-divider type="vertical" />
          <a-button type="primary" danger @click="confirm(record.id)"
            >Delete</a-button
          >
          <a-divider type="vertical" />
        </div>
      </template>
    </template>
  </a-table>
  <div class="flex justify-end my-8" v-if="categories.length > 0">
    <a-pagination
      v-model:current="currentPage"
      :total="total"
      :defaultPageSize="limit"
      :showSizeChanger="true"
      @showSizeChange="handlePageSizeChange"
      :pageSizeOptions="['2', '4', '6', '8']"
    />
  </div>
</template>
<script lang="ts" setup>
import { useCategory } from '@/composables/useCategory';
import { Modal } from 'ant-design-vue';
import { createVNode, onBeforeMount, ref, watch, h } from 'vue';
import { ExclamationCircleOutlined } from '@ant-design/icons-vue';
import { sizeType } from 'ant-design-vue/es/drawer';

const columns = [
  {
    name: 'Name',
    dataIndex: 'name',
    key: 'id',
  },
  {
    title: 'Title',
    dataIndex: 'title',
    key: 'title',
  },
  {
    title: 'Description',
    dataIndex: 'description',
    key: 'description',
  },
  {
    title: 'Action',
    key: 'action',
  },
];

const size = ref<sizeType>('large');
const { categories, total, getListCategories, deleteCategory } = useCategory();
const limit = ref(4);
const currentPage = ref(1);
const idDelete = ref(0);

watch([limit, currentPage], async () => {
  await fetchCategory();
});

onBeforeMount(async () => {
  await fetchCategory();
});

const fetchCategory = async () => {
  await getListCategories({ limit: limit.value, page: currentPage.value });
};

const handlePageSizeChange = (current: number, size: number) => {
  limit.value = size;
};

const confirm = (id: number) => {
  idDelete.value = id;
  Modal.confirm({
    title: 'Confirm',
    icon: createVNode(ExclamationCircleOutlined),
    content: 'Delete item',
    okText: 'Ok',
    cancelText: 'Cancel',
    onOk: async () => {
      await deleteCategory(idDelete.value).then(async () => {
        await fetchCategory();
      });
    },
  });
};
</script>
