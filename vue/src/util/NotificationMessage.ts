import { notification } from 'ant-design-vue';

type NotificationType = 'success' | 'error' | 'info' | 'warning';

export const NotificationMessage = (
  type: NotificationType,
  message: string = 'Notification',
  description?: string
) => {
  notification[type]({
    message: message,
    description: description || 'Create category success.',
  });
};
