// stores/useStore.js
import { defineStore } from 'pinia';

export const useStore = defineStore('home-text-search', {
  state: () => ({
    textSearch: '',
  }),
  actions: {
    change(newText: string) {
      this.textSearch = newText;
    },
  },
  getters: {
    currentTextSearch: (state) => state.textSearch,
  },
});
