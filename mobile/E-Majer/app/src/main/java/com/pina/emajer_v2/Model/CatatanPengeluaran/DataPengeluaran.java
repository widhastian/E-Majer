package com.pina.emajer_v2.Model.CatatanPengeluaran;

public class DataPengeluaran {
    private String id_pengeluaran;
    private String nama;
    private String nominal_pengeluaran;
    private String tgl_pengeluaran;
    private String foto;

    public String getId_pengeluaran() {
        return id_pengeluaran;
    }

    public void setId_pengeluaran(String id_pengeluaran) {
        this.id_pengeluaran = id_pengeluaran;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getNominal_pengeluaran() {
        return nominal_pengeluaran;
    }

    public void setNominal_pengeluaran(String nominal_pengeluaran) {
        this.nominal_pengeluaran = nominal_pengeluaran;
    }

    public String getTgl_pengeluaran() {
        return tgl_pengeluaran;
    }

    public void setTgl_pengeluaran(String tgl_pengeluaran) {
        this.tgl_pengeluaran = tgl_pengeluaran;
    }

    public String getFoto() {
        return foto;
    }

    public void setFoto(String fotoNota) {
        this.foto = fotoNota;
    }
}
