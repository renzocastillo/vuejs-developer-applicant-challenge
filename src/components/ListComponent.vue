<template>
  <h3>Emails List</h3>
<ul>
  <ListItemComponent v-for="item in settings.emails" :key="item" :item="item"/>
</ul>
</template>

<style scoped>

</style>

<script setup lang="ts">
import ListItemComponent from "@/components/ListItemComponent.vue";
import {useSettingsStore} from "@/stores/settings";

const settings = useSettingsStore();
</script>