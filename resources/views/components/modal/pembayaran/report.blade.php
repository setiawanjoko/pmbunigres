<div class="modal fade" id="paymentReport" tabindex="-1" role="dialog" aria-labelledby="paymentReportLabel">
    <div class="modal-dialog" role="document">
        <form action="{{ route('administrator.keuangan.pembayaran.report') }}" method="POST" id="paymentReport">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="paymentReportLabel">Laporan Pembayaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <select name="prodi" id="prodi" class="col form-control form-control-sm @error('prodi') is-invalid @enderror" required>
                            <option value="all">Semua Program Studi</option>
                            @foreach($dataProdi as $key => $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->jenjang->nama . ' ' . $prodi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
