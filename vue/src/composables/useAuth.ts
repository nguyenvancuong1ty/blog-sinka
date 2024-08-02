import { AuthService, User } from '@/services/auth';
import Cookies from 'js-cookie';
import { reactive, ref } from 'vue';

const access_token = Cookies.get('access_token');
const authApi = new AuthService(access_token);
export function useAuth() {
  const me: Record<string, any> = reactive({});

  async function login(user: User): Promise<any> {
    const response = await authApi.login(user);
    if (response.data) {
      Cookies.set('access_token', response.data.access_token, {
        expires: 7,
        path: '/',
      });
    }
    return response;
  }

  async function getMe(): Promise<any> {
    const response = await authApi.getMe();
    me.value = response.data;
  }

  return {
    login,
    getMe,
    me,
  };
}
