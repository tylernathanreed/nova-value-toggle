<template>
    <span>{{ field.field.value }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
