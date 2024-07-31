<template>
  <a-table :columns="columns" :data-source="posts" :pagination="false">
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
      <template v-else-if="column.key === 'thumbnail'">
        <div>
          <img
            v-if="record.thumbnail"
            :src="record.thumbnail"
            alt="Thumbnail"
            class="w-20"
          />
        </div>
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
  <div class="flex justify-end my-8" v-if="posts.length > 0">
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
import { usePost } from '@/composables/usePost';
import { Modal } from 'ant-design-vue';
import { createVNode, onBeforeMount, ref, watch, h } from 'vue';
import { ExclamationCircleOutlined } from '@ant-design/icons-vue';

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
    title: 'Category',
    key: 'category_id',
    customRender: ({ record }) => {
      return record.category ? record.category.title : 'N/A';
    },
  },
  ,
  {
    title: 'Thumbnail',
    key: 'thumbnail',
    dataIndex: 'thumbnail',
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

const { posts, total, getListPosts, deletePost } = usePost();
const limit = ref(4);
const currentPage = ref(1);
const idDelete = ref(0);

watch([limit, currentPage], async () => {
  await fetchPost();
});

onBeforeMount(async () => {
  await fetchPost();
});

const fetchPost = async () => {
  await getListPosts({ limit: limit.value, page: currentPage.value });
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
      await deletePost(idDelete.value).then(async () => {
        await fetchPost();
      });
    },
  });
};
</script>
