<template>
    <component
        :is="'detail-' + field.field.component"
        :resource-id="resourceId"
        :resource-name="resourceName"
        :field="field.field"
    />
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
