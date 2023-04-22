<template>
  <h4>{{ translationStrings.emails_list }}</h4>
<ul>
  <ListItemComponent v-for="item in settings.emails" :key="item" :item="item"/>
</ul>
</template>

<style scoped>
ul {
    list-style: circle;
}
</style>

<script setup lang="ts">
/**
 * A Vue.js component that renders a list of emails.
 *
 * @prop {string} translationStrings.emails_list - The label for the emails list.
 * @vue-import {ListItemComponent} from "@/components/ListItemComponent.vue" - A Vue component used to render a list.
 */
import ListItemComponent from "@/components/ListItemComponent.vue";
import {useSettingsStore} from "@/stores/settings";
import {translationStrings} from "../router";

/**
 * Retrieves settings from the settings store and calls settings API if settings numrows equals to zero.
 */
const settings = useSettingsStore();
</script>