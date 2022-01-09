package com.kelompok.emajer.Model.PembayaranKas;

public class DataMinggu {
    private int id_minggu;
    private Integer nominal;
    private String keterangan;

    public int getId_minggu() {
        return id_minggu;
    }

    public void setId_minggu(int id_minggu) {
        this.id_minggu = id_minggu;
    }

    public Integer getNominal() {
        return nominal;
    }

    public void setNominal(Integer nominal) {
        this.nominal = nominal;
    }

    public String getKeterangan() {
        return keterangan;
    }

    public void setKeterangan(String keterangan) {
        this.keterangan = keterangan;
    }
}
