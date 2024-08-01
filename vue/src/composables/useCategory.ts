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
      const response = await categoryApi.getCategories(params);
      categories.value = response.data.data;
      total.value = response.data.total;
    } catch (error) {
      return;
    }
  }

  async function createCategory(category: Category) {
    const response = await categoryApi.createCategory(category);
    return response;
  }

  async function updateCategory(id: number, category: Category) {
    const response = await categoryApi.updateCategory(id, category);
    return response;
  }

  async function getCategoryById(id: number) {
    const response = await categoryApi.getCategoryById(id);
    return response.data;
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
    updateCategory,
    getListCategories,
    deleteCategory,
    getCategoryById,
  };
}
