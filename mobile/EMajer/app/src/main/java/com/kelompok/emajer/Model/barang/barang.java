package com.kelompok.emajer.Model.barang;

public class barang {
    String Nama_barang, jumlah_barang, foto;


    public String getNama_barang() {
        return Nama_barang;
    }

    public void setNama_barang(String nama_barang) {
        Nama_barang = nama_barang;
    }

    public String getFoto() {
        return foto;
    }

    public void setFoto(String foto) {
        this.foto = foto;
    }

    public String getJumlah_barang() {
        return jumlah_barang;
    }

    public void setJumlah_barang(String jumlah_barang) {
        this.jumlah_barang = jumlah_barang;
    }
}
