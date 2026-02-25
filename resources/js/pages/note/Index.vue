<script setup lang="ts">
import { Form, Head, Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import note from '@/routes/note';
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableFooter,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import { CheckCircle2Icon, Pen, Trash } from 'lucide-vue-next';
import Pagination from '@/components/Pagination.vue';
import Alert from '@/components/ui/alert/Alert.vue';
import AlertTitle from '@/components/ui/alert/AlertTitle.vue';
import AlertDescription from '@/components/ui/alert/AlertDescription.vue';

const page = usePage()
const props = defineProps({ data: Object })

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Note',
        href: note.index().url,
    },
];
</script>

<template>
    <Head title="Note" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="grid grid-cols-12 h-full gap-4 overflow-x-auto rounded-xl p-4"
        >
        <Card class="px-12 py-4 col-span-12">
            <div v-if="page.flash.message" class="toast">
                <Alert class="bg-green-400 text-white">
                    <CheckCircle2Icon />
                    <AlertTitle>{{ page.flash.message }}</AlertTitle>
                    <!-- <AlertDescription>
                        This is an alert with icon, title and description.
                    </AlertDescription> -->
                </Alert>
                    <!-- {{ page.flash.message }} -->
            </div>
            <div class="flex items-center justify-end">
                <Link :href="`note/create`">
                Create Note +
                </Link>
            </div>
            <Table>
                <TableCaption>A list of your recent notes.</TableCaption>
                <TableHeader>
                <TableRow>
                    <TableHead>
                    Action
                    </TableHead>
                    <TableHead>
                    User
                    </TableHead>
                    <TableHead>
                    Title
                    </TableHead>
                    <TableHead>Description</TableHead>
                </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="item in props.data.data" :key="item.id">
                        <TableCell>

                        <Link :href="`/note/${item.id}/edit`" >
                            <Button class="bg-yellow-400 mr-2">
                                <Pen />
                            </Button>
                        </Link>

                        <Link :href="`/note/${item.id}`" method="delete" as="button" >
                            <Button class="bg-red-400">
                                <Trash />
                            </Button>
                        </Link>
                        </TableCell>
                        <TableCell class="font-medium">
                        {{ item.user.name }}
                        </TableCell>
                        <TableCell class="font-medium">
                        {{ item.title }}
                        </TableCell>
                        <TableCell>{{ item.description }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <Pagination :data="props.data" />
        </Card>
        </div>
    </AppLayout>
</template>
