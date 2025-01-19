import { User } from '@/types';
import { type ClassValue, clsx } from 'clsx'
import { twMerge } from 'tailwind-merge'

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

export const ADMIN_ROLE_ALIAS = "A";
export const STAFF_ROLE_ALIAS = "STF";
export const CLIENT_ROLE_ALIAS = "CLI";

export const ROLES = [
    ADMIN_ROLE_ALIAS,
    STAFF_ROLE_ALIAS,
    CLIENT_ROLE_ALIAS
]

export function hasRoles (user: User, roles: string[]): boolean {
    return user.roles.some((role) => roles.includes(role.alias));
}
