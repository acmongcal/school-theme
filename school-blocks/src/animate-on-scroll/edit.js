/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InspectorControls, useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const {animation} = attributes;
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'animate-on-scroll' ) }>
					<SelectControl
						label={ __( 'Animation on Scroll', 'animate-on-scroll' ) }
						value={ animation }
						options={
							[
								{label: 'Slide Up', value:'slide-up'},
								{label: 'Slide Down', value:'slide-down'},
								{label: 'Slide Left', value:'slide-left'},
								{label: 'Slide Right', value:'slide-right'},
								{label: 'Zoom In', value:'zoom-in'}
							]
						}
						onChange={ ( value ) => setAttributes( { animation: value} ) }
						help={ __( 'Sets the animation for the block on scroll', 'animate-on-scroll' ) }
						
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps({'data-aos': animation }) }>
				<InnerBlocks/>
			</div>
		</>
	);
}