export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
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
