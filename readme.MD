## Introduction

X-Form is a fully customized package of Laravel blade components made for Livewire 3.

### Format
X-Form is easy to use and easier to update styles by x-form.config classes
<x-form.tag_name_here model="livewire_model_name_here" label="the title of the field can also be html" modifier="optional:live,blur etc." />  

### Input
A fully customized bootstrap styled input with label, validation and input tag
<x-form.input model="title" label="title" />

### Select
Default list is a boolean yes/no array.

A select tag example with a computed list:
<x-select :list="$this->yourList" model="country" label="Country Of Origin" />
On your livewire component add:
#['Computed']
public function yourList(): array 
{
  return YourModel::....pluck('value', 'text')->toArray();
}

### Checkboxes and Radio Buttons
Same as select regarding data list. To make checkbox or radio horizontal just add horizontal. By default horizontal is false
<x-form.checkbox :list="$this->yourList" model="country" label="Country Of Origin" />

<x-form.radio :list="$this->yourList" model="country" label="Country Of Origin" horizontal />
