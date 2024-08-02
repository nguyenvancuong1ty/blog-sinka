import { BaseService } from './base';

export interface User {
  email: string;
  password: string;
}

export class AuthService extends BaseService {
  constructor(authToken?: string) {
    super(import.meta.env.VITE_API_HOST, authToken);
  }
  public async login(user: User): Promise<any> {
    return this.post<User>('/auth/login', user);
  }

  public async getMe(): Promise<any> {
    return this.get('/auth/me');
  }
}
