export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    kkiapay_key?: string;
    roles: Role[];
}

export interface Role {
    title?: string;
    alias: string;
    description?: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};

export type Product = {
    id: number;
    name: string;
    price: number;
    description?: string;
    category?: string;
    status?: string;
    cover?: string;
    images?: string[];
    user_id?: number;
    user?: User;
    created_at?: string;
    updated_at?: string;
}

export type ProductCategory = {
    id: number;
    name: string;
    description?: string;
    created_at?: string;
    updated_at?: string;
}

export type Order = {
    id: number;
    reference: string;
    customer_id?: number;
    customer: Customer;
    details: OrderDetail[];
    total?: number;
    tax?: number;
    status?: number;
    created_at?: string;
    updated_at?: string;
}

export type OrderDetail = {
    id: number;
    order_id?: number;
    order?: Order;
    product_id?: number;
    product: Prodcut;
    total?: number;
    tax?: number;
    quantity?: number;
    created_at?: string;
    updated_at?: string;
}

export type Customer = {
    id: number;
    reference: string;
    name? :string;
    email? :string;
    contact? :string;
    address?: string;
    user_id?: number;
    user?: User;
    created_at?: string;
    updated_at?: string;
}
