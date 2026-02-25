<script setup lang="ts">
import { Form, Head, Link, useForm } from '@inertiajs/vue3';
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
import { title } from 'process';


defineProps({ data: Object })

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Note',
        href: note.index().url,
    },
];

const form = useForm({
    title: null,
    description: null,
})
</script>

<template>
    <Head title="Note" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="grid grid-cols-12 h-full gap-4 overflow-x-auto rounded-xl p-4"
        >

        <Card class="px-12 py-4 col-span-12">
            <h2>Create a new note</h2>

            <div class="flex justify-start">
                <Link href="/note">
                    <- Back
                </Link>
            </div>

            <Form @submit.prevent="form.post('/note')" method="put">
                <div class="grid gap-y-4">
                    <div class="grid gap-2">
                        <Label for="title">Title</Label>
                        <Input
                            id="title"
                            type="text"
                            v-model="form.title"
                            autofocus
                            :tabindex="1"
                            autocomplete="title"
                            placeholder="Enter title"
                        />
                        <span v-if="form.errors.title" class="text-red-500">
                            {{ form.errors.title }}
                        </span>
                    </div>
                    <div class="grid gap-2">
                        <Label for="description">Description</Label>
                        <Textarea
                            id="description"
                            type="text"
                            v-model="form.description"
                            :tabindex="2"
                            autocomplete="description"
                            placeholder="Enter description"
                        ></Textarea>
                        <span v-if="form.errors.title" class="text-red-500">
                            {{ form.errors.description }}
                        </span>
                    </div>
                    <Button type="submit">Submit</Button>
                </div>
            </Form>
        </Card>
        </div>
    </AppLayout>
</template>
