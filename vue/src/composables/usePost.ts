import { Post, PostService } from '../services/post';
import { ref } from 'vue';

const postApi = new PostService();

export function usePost() {
  const posts = ref<Array<Post>>([]);
  const total = ref(0);

  async function getListPosts(params: any = {}) {
    const { category_id, search, page, limit } = params;
    params = {
      category_id: category_id,
      search: search || '',
      page: page || 1,
      limit: limit || 10,
    };
    try {
      const res = await postApi.getPosts(params);
      posts.value = res.data.data;
      total.value = res.data.total;
    } catch (error) {
      return;
    }
  }
  async function deletePost(id: number) {
    try {
      await postApi.deletePost(id);
    } catch (error) {
      return;
    }
  }
  return {
    posts,
    total,
    getListPosts,
    deletePost,
  };
}
