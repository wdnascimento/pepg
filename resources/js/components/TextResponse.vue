<template>
    <div class="text-response">
        <h4 class="text-center w-100">Resposta do Setor:</h4>
        <div class="response-content">
            <p class="response-text">{{ text }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TextResponse',
    props: {
        text: {
            type: String,
            required: true,
            default: ''
        }
    }
}
</script>

<style scoped>
.text-response {
    width: 100%;
    padding: 20px;
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.response-content {
    max-height: 400px;
    overflow-y: auto;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 5px;
    border-left: 4px solid #007bff;
}

.response-text {
    color: #495057;
    font-size: 15px;
    line-height: 1.6;
    margin: 0;
    word-wrap: break-word;
    white-space: pre-wrap;
}

/* Scrollbar customizado */
.response-content::-webkit-scrollbar {
    width: 12px;
}

.response-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 5px;
}

.response-content::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 5px;
}

.response-content::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
