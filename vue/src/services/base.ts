import axios, { AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios';

export class BaseService {
  private http: AxiosInstance;
  private authToken?: string;

  constructor(baseURL: string, authToken?: string) {
    this.authToken = authToken;
    this.http = axios.create({
      baseURL,
      headers: {
        'Content-Type': 'application/json',
        Authorization: this.authToken ? `Bearer ${this.authToken}` : '',
      },
    });
  }

  public setAuthToken(token: string) {
    this.authToken = token;
    this.http.defaults.headers['Authorization'] = `Bearer ${token}`;
  }

  // GET METHOD
  public get<T>(url: string, params?: Record<string, any>): Promise<T> {
    return this.http
      .get<T>(url, { params })
      .then((response: AxiosResponse<T>) => response.data)
      .catch((error) => {
        throw new Error(`GET request failed: ${error.message}`);
      });
  }

  // POST METHOD
  public post<T>(url: string, data?: any): Promise<T> {
    return this.http
      .post<T>(url, data)
      .then((response: AxiosResponse<T>) => response.data)
      .catch((error) => {
        console.log(error);
        return error.response.data;
      });
  }

  // PUT METHOD
  public put<T>(url: string, data?: any): Promise<T> {
    return this.http
      .put<T>(url, data)
      .then((response: AxiosResponse<T>) => response.data)
      .catch((error) => {
        throw new Error(`PUT request failed: ${error.message}`);
      });
  }

  // DELETE METHOD
  public delete<T>(url: string): Promise<T> {
    return this.http
      .delete<T>(url)
      .then((response: AxiosResponse<T>) => response.data)
      .catch((error) => {
        throw new Error(`DELETE request failed: ${error.message}`);
      });
  }
}
