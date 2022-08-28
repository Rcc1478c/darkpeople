<?php

namespace App\Http\Livewire\Backend\Pages;

use App\Models\Menu;
use App\Models\Page as ModelsPage;
use Livewire\Component;

class Page extends Component {

    public $pages, $page, $addPage, $updatePage, $show_parent;

    public function mount() {
        $this->updatePages();
        $this->clearPageObject();
        $this->addPage = false;
        $this->updatePage = false;
    }

    public function updatePages() {
        $this->pages = ModelsPage::get();
        $this->updatePagesParent();
    }

    public function updatePagesParent() {
        foreach ($this->pages as $page) {
            if ($page->parent_id) {
                $parent = $page->parent();
                $page->parent_slug = $parent->slug;
            }
        }
    }

    public function clearAddUpdate() {
        $this->addPage = false;
        $this->updatePage = false;
        $this->clearPageObject();
        $this->updatePagesParent();
    }

    public function clearPageObject() {
        $this->page = [
            'title' => '',
            'content' => '',
            'slug' => '',
            'parent_id' => null,
            'meta' => [],
            'header' => null
        ];
        $this->show_parent = true;
    }

    public function add() {
        $this->dispatchBrowserEvent('componentUpdated');
        $this->validate(
            [
                'page.title' => 'required',
                'page.content' => 'required',
                'page.slug' => 'required',
                'page.meta.*.name' => 'required',
                'page.meta.*.content' => 'required'
            ],
            [
                'page.title.required' => 'Page Title is Required',
                'page.content.required' => 'Please enter some Content for the Page',
                'page.slug.required' => 'Page Slug is Required',
                'page.meta.*.name.required' => 'Meta Tag Name is Required',
                'page.meta.*.content.required' => 'Meta Tag Content is Required'
            ]
        );
        if ($this->page['parent_id'] == 0) {
            $this->page['parent_id'] = null;
        }
        $this->page['meta'] = serialize($this->page['meta']);
        $this->createMenu();
        ModelsPage::create($this->page);
        $this->emit('saved');
        $this->updatePages();
        $this->clearAddUpdate();
    }

    public function showUpdate($page) {
        $this->updatePage = true;
        $this->page = $page;
        $this->page['meta'] = $this->page['meta'] ? unserialize($this->page['meta']) : [];
        if (ModelsPage::where('parent_id', $page['id'])->count() > 0) {
            $this->show_parent = false;
        }
    }

    public function update() {
        $this->dispatchBrowserEvent('componentUpdated');
        $this->validate(
            [
                'page.title' => 'required',
                'page.content' => 'required',
                'page.slug' => 'required',
                'page.meta.*.name' => 'required',
                'page.meta.*.content' => 'required'
            ],
            [
                'page.title.required' => 'Page Title is Required',
                'page.content.required' => 'Please enter some Content for the Page',
                'page.slug.required' => 'Page Slug is Required',
                'page.meta.*.name.required' => 'Meta Tag Name is Required',
                'page.meta.*.content.required' => 'Meta Tag Content is Required'
            ]
        );
        if ($this->page['parent_id'] == 0) {
            $this->page['parent_id'] = null;
        }
        $page = ModelsPage::findOrFail($this->page['id']);
        $temp = $this->page['meta'];
        $this->page['meta'] = serialize($this->page['meta']);
        $page->fill($this->page);
        $page->save();
        $this->page['meta'] = $temp;
        $this->emit('saved');
    }

    public function delete($page) {
        $page = ModelsPage::findOrFail($page['id']);
        $childs = $page->getChild();
        if (count($childs) > 0) {
            foreach ($childs as $child) {
                $child->parent_id = null;
                $child->save();
            }
        }
        $page->delete();
        $this->updatePages();
    }

    public function addMeta() {
        array_push($this->page['meta'], [
            'name' => '',
            'content' => ''
        ]);
        $this->dispatchBrowserEvent('componentUpdated');
    }

    public function deleteMeta($key) {
        unset($this->page['meta'][$key]);
        $this->dispatchBrowserEvent('componentUpdated');
    }

    public function render() {
        return view('backend.pages.page');
    }

    /** Function to Create Menu Item for newly created Page */
    private function createMenu() {
        $menu = new Menu;
        $menu->name = $this->page['title'];
        if ($this->page['parent_id']) {
            $parent = ModelsPage::findOrFail($this->page['parent_id']);
            $menu->link = env('APP_URL') . '/' . $parent->slug . '/' . $this->page['slug'];
        } else {
            $menu->link = env('APP_URL') . '/' . $this->page['slug'];
        }
        $menu->parent_id = null;
        $order = Menu::select('order')->where('parent_id', null)->orderBy('order', 'desc')->first();
        $menu->order = (($order) ? $order->order : 0) + 1;
        $menu->target = '_self';
        $menu->status = true;
        $menu->save();
    }
}
