class Link {
    constructor() {
        this.containerId = 'element-wise-value';
        this.createInputFieldsForHyperlink = this.createInputFieldsForHyperlink.bind(this);
    }
     createInputFieldsForHyperlink() {
    let webAddressBn = '';
    let webAddressEn = '';
    let linkType='paragraph_link';
    if (elementProperties) {
        webAddressBn = elementProperties.web_address_bn ?? '';
        webAddressEn = elementProperties.web_address_en ?? '';
        linkType=elementProperties.link_type??'paragraph_link';

    }

    document.getElementById(this.containerId).innerHTML = ` <div class="form-group col-md-4 mb-3">
                                                                <label for="link-type">Link type:</label>
                                                                <select class="form-control"  name="link_type" id="link-type">
                                                                    <option value="paragraph_link" ${linkType === 'paragraph_link' ? 'selected' : ''}>Paragraph Link</option>
                                                                    <option value="video_link" ${linkType === 'video_link' ? 'selected' : ''}>Video Link</option>
                                                                     <option value="button_link" ${linkType === 'button_link' ? 'selected' : ''}>Button Link</option>
                                                                     <option value="download_link" ${linkType === 'download_link' ? 'selected' : ''}>Download Button</option>
                                                                      <option value="blog_link" ${linkType === 'blog_link' ? 'selected' : ''}>Blog Link</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="web-address-bn">Web Address (BN) :</label>
                                                                <input class="form-control" type="text" name="web_address_bn" id="web-address-bn" value="${webAddressBn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="web-address-en">Web Address (EN) :</label>
                                                                <input class="form-control" type="text" name="web_address_en" id="web-address-en" value="${webAddressEn}">
                                                            </div>
                                                            <div id="link-text-container" class="row">

                                                            </div>
                                                                `;
         if(linkType==='download_link'||linkType==='blog_link'){
             this.createInputFieldsForLinkText('link-text-container');
         }
    document.getElementById('link-type').addEventListener('change',(event)=> {
       let containerId='link-text-container';
        let linkType=event.target.value;
        removeAllChildren(containerId);
        if(linkType==='download_link'||linkType==='blog_link'){
            this.createInputFieldsForLinkText(containerId)
        }
    })
}

 createInputFieldsForLinkText(containerId) {
    let linkTextEn='';
    let linkTextBN='';
    if (elementProperties){
        linkTextEn=elementProperties.link_text_en ?? '';
        linkTextBN=elementProperties.link_text_bn?? '';
    }
    document.getElementById(containerId).innerHTML=`  <div class="form-group col-md-4 mb-3">
                                                                <label for="link-text-en">Link Text (EN) :</label>
                                                                <input class="form-control" type="text" name="link_text_en" id="link-text-en" value="${linkTextEn}">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-3">
                                                                <label for="link-text-bn">Link Text (BN) :</label>
                                                                <input class="form-control" type="text" name="link_text_bn" id="link-text-bn" value="${linkTextBN}">
                                                            </div>`

}
}
