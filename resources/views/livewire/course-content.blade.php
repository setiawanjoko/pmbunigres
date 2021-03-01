<div class="card">
    <div class="card-body">
        <div class="form-row">
            <div class="form-group">
                <label for="topik">Pilih Topik</label>
                <select wire:model="chosenCourse" wire:change="$emit('courseChange')" name="topik" id="topik" class="form-control form-control-sm">
                    @foreach($courses as $coursee)
                        <option value="{{ $coursee['id'] }}" @if(!empty($chosenCourse) && $coursee['id'] == $chosenCourse) selected @endif>{{ $coursee['fullname'] }}</option>
                    @endforeach
                </select>
                @if($errors->has('topik'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('topik') }}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="konten">Pilih Konten</label>
                <select wire:model="chosenContent" name="konten" id="konten" class="form-control form-control-sm">
                    @foreach($contents as $content)
                        <option value="{{ $content['id'] }}" @if(!empty($chosenContent) && $coursee['id'] == $chosenCourse) selected @endif>{{ $content['name'] }}</option>
                    @endforeach
                </select>
                @if($errors->has('konten'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('konten') }}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="modul">Pilih Modul</label>
                <select wire:model="chosenModule" name="modul" id="modul" class="form-control form-control-sm">
                    @foreach($modules as $module)
                        <option value="{{ $module['id'] }}" @if(!empty($chosenModule) && $module['id'] == $chosenModule) selected @endif>{{ $module['name'] }}</option>
                    @endforeach
                </select>
                @if($errors->has('modul'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('modul') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>
    </div>
</div>
