<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import {
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    useSidebar,
} from '@/components/ui/sidebar';
import {
  Pagination,
  PaginationContent,
  PaginationEllipsis,
  PaginationItem,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination'

defineProps({
  data: Object
})
</script>

<template>
    <Pagination v-slot="{ page }" :items-per-page="data.per_page" :total="data.total" :default-page="data.current_page">
        <PaginationContent v-slot="{ items }">
            <Link :href="data.prev_page_url ?? ''">
                <PaginationPrevious />
            </Link>
            <template v-for="(item, index) in items" :key="index">
                <Link :href="`?page=${item.value}`">
                    <PaginationItem
                        v-if="item.type === 'page'"
                        :value="item.value"
                        :is-active="item.value === page"
                    >
                        {{ item.value }}
                    </PaginationItem>
                </Link>
                <!-- <PaginationEllipsis :index="10" /> -->
            </template>
            <Link :href="data.next_page_url ?? ''">
                <PaginationNext />
            </Link>
        </PaginationContent>
    </Pagination>
</template>
