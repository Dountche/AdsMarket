<div class="mb-3">
  <label>Titre</label>
  <input name="title" class="form-control" value="{{ old('title', $ad->title ?? '') }}" required>
</div>
<div class="mb-3">
  <label>Description</label>
  <textarea name="description" class="form-control" rows="5" required>{{ old('description', $ad->description ?? '') }}</textarea>
</div>
<div class="mb-3">
  <label>Prix (€)</label>
  <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $ad->price ?? '') }}">
</div>
<div class="mb-3">
  <label>Catégorie</label>
  <select name="category_id" class="form-select">
    <option value="">-- Choisir --</option>
    @foreach(\App\Models\Category::all() as $cat)
      <option value="{{ $cat->id }}" @selected(old('category_id', $ad->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
    @endforeach
  </select>
</div>
<div class="mb-3">
  <label>Photos</label>
  <input type="file" name="photos[]" multiple class="form-control">
  @if(isset($ad) && $ad->photos->count())
    <div class="mt-2">
      @foreach($ad->photos as $photo)
        <img src="{{ asset('storage/' . $photo->path) }}" width="80" class="me-2 mb-2">
      @endforeach
    </div>
  @endif
</div>
