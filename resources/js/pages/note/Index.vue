<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
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
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import Card from '@/components/ui/card/Card.vue';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import Button from '@/components/ui/button/Button.vue';
import PopoverTrigger from '@/components/ui/popover/PopoverTrigger.vue';
import Popover from '@/components/ui/popover/Popover.vue';
import PopoverContent from '@/components/ui/popover/PopoverContent.vue';
import { Pen, Trash } from 'lucide-vue-next';


defineProps({ data: Object })

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
                    <TableRow v-for="item in data" :key="item.id">
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
        </Card>
        </div>
    </AppLayout>
</template>
