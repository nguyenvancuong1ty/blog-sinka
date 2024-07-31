import { Category, CategoryService } from '../services/category';
import { ref } from 'vue';

const categoryApi = new CategoryService();

export function useCategory() {
  const categories = ref<Array<Category>>([]);
  const total = ref(0);

  async function getListCategories(params: any = {}) {
    const { search, page, limit } = params;
    params = {
      search: search || '',
      page: page || 1,
      limit: limit || 10,
    };
    try {
      const res = await categoryApi.getCategories(params);
      categories.value = res.data.data;
      total.value = res.data.total;
    } catch (error) {
      return;
    }
  }

  async function createCategory(category: Category) {
    const res = await categoryApi.createCategory(category);
    return res;
  }

  async function deleteCategory(id: number) {
    try {
      await categoryApi.deleteCategory(id);
    } catch (error) {
      return;
    }
  }

  return {
    categories,
    total,
    createCategory,
    getListCategories,
    deleteCategory,
  };
}
