import { defineStore, acceptHMRUpdate } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [],
  }),
  persist: true,
  getters: {
    cartTotal(state) {
      return state.items.reduce((total, item) => total + item.price * item.quantity, 0);
    },
    cartCount(state) {
      return state.items.reduce((count, item) => count + item.quantity, 0);
    },
  },
  actions: {
    addItem(product) {
      const existingItem = this.items.find((item) => item.id === product.id);
      if (existingItem) {
        existingItem.quantity++;
      } else {
        let productItem = {
            id :product.id,
            name :product.name,
            price :product.price,
            cover: product.cover,
            quantity :1
        }
        this.items.push(productItem);
      }
    },
    removeItem(productId) {
      this.items = this.items.filter((item) => item.id !== productId);
    },
    updateQuantity(productId, quantity) {
      const item = this.items.find((item) => item.id === productId);
      if (item && quantity > 0) {
        item.quantity = quantity;
      } else {
        this.removeItem(productId);
      }
    },
    clearCart() {
      this.items = [];
    },
  },
});

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useCartStore, import.meta.hot))
  }
