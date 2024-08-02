import { useAuth } from '@/composables/useAuth';

const { me, getMe } = useAuth();

export async function isAuthorized(): Promise<boolean> {
  await getMe().catch(() => {
    return false;
  });

  if (!me.value) {
    return false;
  }
  return true;
}
