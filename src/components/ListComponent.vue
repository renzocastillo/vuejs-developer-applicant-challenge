<template>
  <h4>{{ translationStrings.emails_list }}</h4>
<ul>
  <ListItemComponent v-for="item in settings.emails" :key="item" :item="item"/>
</ul>
</template>

<style scoped>

</style>

<script setup lang="ts">
import ListItemComponent from "@/components/ListItemComponent.vue";
import {useSettingsStore} from "@/stores/settings";
import {translationStrings} from "../router";

const settings = useSettingsStore();
if (settings.numrows == 0) {
    await settings.callSettings();
}
</script>