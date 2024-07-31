import { BaseService } from './base';

export interface Category {
  [x: string]: any;
  id?: number;
  title: string;
  description?: string;
}

export class CategoryService extends BaseService {
  constructor(authToken?: string) {
    super(import.meta.env.VITE_API_HOST, authToken);
  }

  public async getCategories(params?: Record<string, any>): Promise<any> {
    return this.get<Category[]>('/category', params);
  }

  public async getCategory(id: number): Promise<Category> {
    return this.get<Category>(`/category/${id}`);
  }

  public async createCategory(category: Category): Promise<Category> {
    return this.post<Category>('/category/create-or-update', category);
  }

  public async updateCategory(
    id: number,
    category: Partial<Category>
  ): Promise<Category> {
    return this.put<Category>(`/category/${id}`, category);
  }

  public async deleteCategory(id: number): Promise<void> {
    return this.delete<void>(`/category/delete/${id}`);
  }
}
