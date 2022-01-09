package com.kelompok.emajer.Model.barang;

import java.util.List;

public class DataBarangResponse{
    private int kode;
    private String pesan;
    private List<barang> data;

    public int getKode() {
        return kode;
    }

    public void setKode(int kode) {
        this.kode = kode;
    }

    public String getPesan() {
        return pesan;
    }

    public void setPesan(String pesan) {
        this.pesan = pesan;
    }

    public List<barang> getData() {
        return data;
    }

    public void setData(List<barang> data) {
        this.data = data;
    }
}
