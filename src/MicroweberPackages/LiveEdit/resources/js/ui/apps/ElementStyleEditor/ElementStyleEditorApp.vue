<template>

    <ElementStyleEditorActiveNode></ElementStyleEditorActiveNode>


    <div v-if="!selectedElement" class="mb-4">
        <div class="alert alert-primary">Please select an element to edit</div>
    </div>

    <div class="mb-4" :class="{'style-editor-disabled': !selectedElement}">
        <div class="d-flex flex-column">



            <div class="mb-4" v-show="showElementSelector">
                <ElementStyleEditorElementSelector></ElementStyleEditorElementSelector>
            </div>


            <div class="mb-4" v-show="showTypography">
                <ElementStyleEditorTypography></ElementStyleEditorTypography>
            </div>

            <div class="mb-4" v-show="showBackground">
                <ElementStyleEditorBackground></ElementStyleEditorBackground>
            </div>

            <div class="mb-4" v-show="showSpacing">
                <ElementStyleEditorSpacing></ElementStyleEditorSpacing>
            </div>

            <div v-show="showContainer">
                <ElementStyleEditorContainer></ElementStyleEditorContainer>
            </div>

            <div v-show="showGrid">
                <ElementStyleEditorGrid></ElementStyleEditorGrid>
            </div>

            <div class="mb-4" v-show="showBorder">
                <ElementStyleEditorBorder></ElementStyleEditorBorder>
            </div>

            <div class="mb-4" v-show="showRoundedCorners">
                <ElementStyleEditorRoundedCorners></ElementStyleEditorRoundedCorners>
            </div>

            <div v-show="showAnimations">
                <ElementStyleEditorAnimations></ElementStyleEditorAnimations>
            </div>

            <div class="mb-4" v-show="showClassApplier">
                <ElementStyleEditorShadow></ElementStyleEditorShadow>
            </div>

            <div class="mb-4" v-show="showClassApplier">
                <ElementStyleEditorClassApplier></ElementStyleEditorClassApplier>
            </div>


<!--
<div class="mb-4" v-show="showPosition">
                <ElementStyleEditorPosition></ElementStyleEditorPosition>
            </div>-->

            <div class="mb-4" v-show="showListStyleEditor">
                <ElementStyleEditorUlOlListStyleEditor></ElementStyleEditorUlOlListStyleEditor>
            </div>

            <div class="mb-4" v-show="showLayoutSettings">
                <ElementStyleEditorLayoutSettings></ElementStyleEditorLayoutSettings>
            </div>
     <div class="mb-4" v-show="showPredefinedStylesApplierSettings">
                <ElementStyleEditorPredefinesStylesApplier></ElementStyleEditorPredefinesStylesApplier>
            </div>


        </div>
    </div>


</template>
<style src="./ElementStyleEditor.css"></style>

<script>
import ElementStyleEditorActiveNode from './ElementStyleEditorActiveNode.vue';
import ElementStyleEditorTypography from './ElementStyleEditorTypography.vue';
import ElementStyleEditorSpacing from './ElementStyleEditorSpacing.vue';
import ElementStyleEditorBackground from './ElementStyleEditorBackground.vue';
import ElementStyleEditorBorder from './ElementStyleEditorBorder.vue';
import ElementStyleEditorElementSelector from './ElementStyleEditorElementSelector.vue';
import ElementStyleEditorContainer from './ElementStyleEditorContainer.vue';
import ElementStyleEditorAnimations from './ElementStyleEditorAnimations.vue';
import ElementStyleEditorGrid from './ElementStyleEditorGrid.vue';
import ElementStyleEditorClassApplier from './ElementStyleEditorClassApplier.vue';
import ElementStyleEditorRoundedCorners from "./ElementStyleEditorRoundedCorners.vue";
import ElementStyleEditorShadow from "./ElementStyleEditorShadow.vue";
import ElementStyleEditorLayoutSettings from "./ElementStyleEditorLayoutSettings.vue";
import ElementStyleEditorPosition from "./ElementStyleEditorPosition.vue";
import ElementStyleEditorUlOlListStyleEditor from "./ElementStyleEditorUlOlListStyleEditor.vue";
import ElementStyleEditorPredefinesStylesApplier from "./ElementStyleEditorPredefinesStylesApplier.vue";

export default {
    components: {
        ElementStyleEditorActiveNode,
        ElementStyleEditorBackground,
        ElementStyleEditorRoundedCorners,
        ElementStyleEditorElementSelector,
        ElementStyleEditorTypography,
        ElementStyleEditorSpacing,
        ElementStyleEditorBorder,
        ElementStyleEditorContainer,
        ElementStyleEditorGrid,
        ElementStyleEditorAnimations,
        ElementStyleEditorShadow,
        ElementStyleEditorClassApplier,
        ElementStyleEditorLayoutSettings,
        ElementStyleEditorPosition,
        ElementStyleEditorUlOlListStyleEditor,
        ElementStyleEditorPredefinesStylesApplier,
    },

    data() {
        return {
            selectedElement: null,
            selectedLayout: null,
            showElementSelector: true,
            showBackground: true,
            showTypography: true,
            showSpacing: true,
            showBorder: true,
            showContainer: true,
            showGrid: true,
            showAnimations: true,
            showClassApplier: true,
            showRoundedCorners: true,
            showPosition: true,
            showListStyleEditor: true,
            showLayoutSettings: true,
            showImageSettings: true,
            showPredefinedStylesApplierSettings: true,
        }
    },

    methods: {

        applyPropertyToActiveNode(activeNode, prop, val) {

            mw.top().app.dispatch('mw.elementStyleEditor.applyCssPropertyToNode', {
                node: activeNode,
                prop: prop,
                val: val
            });
        },

    },
    mounted() {

        mw.top().app.on('cssEditorSettings', (settings) => {

            if (settings.fieldSettings.components) {

                this.showBackground = false;
                this.showTypography = false;
                this.showSpacing = false;
                this.showBorder = false;
                this.showElementSelector = false;
                this.showContainer = false;
                this.showAnimations = false;
                this.showClassApplier = false;
                this.showPosition = false;
                this.showListStyleEditor = false;
                this.showLayoutSettings = false;

                if (settings.fieldSettings.components.includes('background')) {
                    this.showBackground = true;
                }
                if (settings.fieldSettings.components.includes('elementSelector')) {
                    this.showElementSelector = true;
                }
                if (settings.fieldSettings.components.includes('typography')) {
                    this.showTypography = true;
                }
                if (settings.fieldSettings.components.includes('spacing')) {
                    this.showSpacing = true;
                }

                if (settings.fieldSettings.components.includes('border')) {
                    this.showBorder = true;
                }
                if (settings.fieldSettings.components.includes('container')) {
                    this.showContainer = true;
                }
                if (settings.fieldSettings.components.includes('grid')) {
                    this.showGrid = true;
                }

                if (settings.fieldSettings.components.includes('animations')) {
                    this.showAnimations = true;
                }

                if (settings.fieldSettings.components.includes('roundedCorners')) {
                    this.showRoundedCorners = true;
                }
                if (settings.fieldSettings.components.includes('position')) {
                    this.showPosition = true;
                }

                if (settings.fieldSettings.components.includes('classes')) {
                    this.showClassApplier = true;
                }

                if (settings.fieldSettings.components.includes('listStyleEditor')) {
                    this.showListStyleEditor = true;
                }

                if (settings.fieldSettings.components.includes('layoutSettings')) {
                    this.showLayoutSettings = true;
                }

                if (settings.fieldSettings.components.includes('imageSettings')) {
                    this.showImageSettings = true;
                }

                if (settings.fieldSettings.components.includes('predefinedStylesApplierSettings')) {
                    this.showPredefinedStylesApplierSettings = true;
                }

            }
        });

    },


}
</script>


