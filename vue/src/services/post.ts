import { BaseService } from './base';

export interface Post {
  id: number;
  category_id: number;
  title: string;
  thumbnail: string;
  description: string;
  created_at: Date;
}

export class PostService extends BaseService {
  constructor(authToken?: string) {
    super(import.meta.env.VITE_API_HOST, authToken);
  }

  public async getPosts(params?: Record<string, any>): Promise<any> {
    return this.get<Post[]>('/post', params);
  }

  public async getPostById(id: number): Promise<Post> {
    return this.get<Post>(`/post/${id}`);
  }

  public async createPost(post: Post): Promise<Post> {
    return this.post<Post>('/post/create-or-update', post);
  }

  public async updatePost(id: number, post: Partial<Post>): Promise<Post> {
    return this.post<Post>(`/post/create-or-update`, {
      id,
      ...post,
    });
  }

  public async deletePost(id: number): Promise<void> {
    return this.delete<void>(`/post/delete/${id}`);
  }
}
